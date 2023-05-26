import React, { useState } from 'react';

const Select = (props) => {
  const [selectedOption, setSelectedOption] = useState('');

  const handleSelectChange = (event) => {
    setSelectedOption(event.target.value);
    sendDataToParent(event)
  };

  const sendDataToParent = (event) => {
    props.sendData(event);
  };

  return (
    <div className="col-md-2">
      <select className="form-control" name={props.name} value={selectedOption} onChange={handleSelectChange}>
        <option value="">{props.name.charAt(0).toUpperCase() + props.name.slice(1) + '...'}</option>
        {props.options?.map((item) => (
          <option key={item.id} value={item.id}>
            {item.name}
          </option>
        ))}
      </select>
    </div>
  );
};

export default Select;