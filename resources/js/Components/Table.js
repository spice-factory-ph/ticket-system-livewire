import React, { useState, useEffect, useMemo } from "react";
import ReactDOM from "react-dom/client";
import DataTable from 'react-data-table-component';
import Select from "./Select";
import DeleteForm from "./DeleteForm";

function Table(props) {
  const columns = [
    {
      name: 'Title',
      selector: row => row.title,
      sortable: true,
    },
    {
      name: 'Type',
      selector: row => row.type.name,
      sortable: true,
    },
    {
      name: 'Priority',
      selector: row => row.priority.name,
      sortable: true,
    },
    {
      name: 'Status',
      selector: row => row.status.name,
      sortable: true,
    },
    {
      name: 'Assignee',
      selector: row => row.assignee.name,
      sortable: true,
    },
    {
      name: 'Reporter',
      selector: row => row.reporter.name,
      sortable: true,
    },
    {
      name: 'Actions',
      cell: (row) => (
        <div>
          <button className="btn btn-secondary me-3" onClick={() => { handleRedirect(row) }}>
            <i className="fa-solid fa-pencil"></i>
          </button>
          <DeleteForm ticketId={row.id} csrf_token={props.csrf_token} />
        </div>
      ),
    },
  ];

  const handleRedirect = (row) => {
    window.location.href = `/tickets/${row.id}/edit`;
  };

  const [query, setQuery] = useState("");
  const [items, setItems] = useState([]);
  const [fields, setFields] = useState([]);
  const [search, setSearch] = useState([]);

  useEffect(() => {
    const fetchFields = async () => {
      await axios
        .get('/api/fields')
        .then(response => setFields(response.data));
    }
    fetchFields();
  }, []);

  useEffect(() => {
    const fetchTickets = async () => {
      await axios
        .get(`/api/search?search=${query}${search}`)
        .then(response => setItems(response.data));
    }

    fetchTickets();
  }, [query, search]);

  const handleData = (event) => {
    setSearch(search + `&${event.target.name}=${event.target.value}`)
  };


  return (
    <React.Fragment>
      <div>
        <div className="mb-3 row g-3">
          <div className="col-md-2">
            <input type="text" className="form-control" onChange={(e) => setQuery(e.target.value)} placeholder="Search" />
          </div>
          <Select name="assignee" options={fields.users} sendData={handleData} />
          <Select name="type" options={fields.types} sendData={handleData} />
          <Select name="status" options={fields.statuses} sendData={handleData} />
          <Select name="priority" options={fields.priorities} sendData={handleData} />
          <DataTable
            columns={columns}
            data={items}
            pagination
            selectableRows
            persistTableHead
          />
        </div>
      </div>
    </React.Fragment>
  );
};

$(function () {
  const root = ReactDOM.createRoot(document.getElementById("react-table"));
  const csrf = document.getElementById("react-table").getAttribute("csrf_token");
  root.render(
    <React.StrictMode>
      <Table csrf_token={csrf} />
    </React.StrictMode>
  );
});

export default Table