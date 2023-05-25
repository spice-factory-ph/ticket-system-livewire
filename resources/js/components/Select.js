import React from 'react';
import ReactDOM from "react-dom/client";

function Select(props) {
  const handleColumnChange = (event) => {
    props.sendDataToParent(event);
  }
  return (
    <div className="col-md-2">
      <select
        onChange={handleColumnChange}
        name={props.name}
        className="form-control"
      >
        <option></option>
        {props?.data?.map((value) => (
          <option value={value.id} key={value.id}>{value.name}</option>
        ))}
      </select>
    </div>

  );
};

export default Select;
