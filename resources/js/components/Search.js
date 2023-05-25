import React, { useState, useEffect } from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter, Link } from 'react-router-dom';
import Table from './Table';
import Select from './Select';

export default function Search() {
  const [columns, setColumn] = useState([]);
  const [items, setItems] = useState([]);
  const [query, setQuery] = useState("");
  const [dataFromChild, setDataFromChild] = useState('');

  const handleDataFromChild = (data) => {
    setDataFromChild(data);
    search(data)
  };

  useEffect(() => {
    axios
      .get('/api/search')
      .then(function (response) {
        setItems(response?.data);
      });

    axios
      .get('/api/columns')
      .then(function (response) {
        setColumn(response?.data)
      });

  }, []);

  const search = async (event) => {
    let value = event.target.value;
    let name = event.target.name;
    let data = [];
    data[name] = value
    console.log(data);
    await axios
      .get('/api/search', {
        params: {
          name: name,
          value: value
        }
      })
      .then(function (response) {
        setItems(response?.data);
      });
  };

  const handleQueryChange = async (event) => {
    let value = event.target.value;
    setQuery(value)

    search(event)
  };

  return (
    <React.Fragment>
      <div className="col-md-2">
        <input
          type="text"
          name="search"
          className="form-control"
          value={query}
          onChange={handleQueryChange}
          placeholder="Search"
        />
      </div>
      <Select name="assignee" data={columns.users} sendDataToParent={handleDataFromChild} />
      <Select name="type" data={columns.types} sendDataToParent={handleDataFromChild} />
      <Select name="priority" data={columns.priorities} sendDataToParent={handleDataFromChild} />
      <Select name="status" data={columns.statuses} sendDataToParent={handleDataFromChild} />
      <Table data={items} />
    </React.Fragment>
  );
}

$(function () {
  const root = ReactDOM.createRoot(document.getElementById("search"));
  root.render(
    <React.StrictMode>
      <BrowserRouter>
        <Search />
      </BrowserRouter>
    </React.StrictMode>
  );
});