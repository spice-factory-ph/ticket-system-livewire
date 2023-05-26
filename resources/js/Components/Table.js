import React, { useState, useEffect, useMemo } from "react";
import ReactDOM from "react-dom/client";
import DataTable from 'react-data-table-component';
import Select from "./Select";

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
];

function Table() {
  const [query, setQuery] = useState("");
  const [items, setItems] = useState([]);

  useEffect(() => {
    const fetchTickets = async () => {
      axios
        .get(`/api/search?search=${query}`)
        .then(response => setItems(response.data.data));
    }
    fetchTickets()
  }, [query]);
  
  return (
    <React.Fragment>
      <div>
        <div className="mb-3 row g-3">
          <div className="col-md-2">
            <input type="text" className="form-control" onChange={(e) => setQuery(e.target.value)} placeholder="Search" />
          </div>
          <Select name="assignee" />
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
  root.render(
    <React.StrictMode>
      <Table />
    </React.StrictMode>
  );
});

export default Table