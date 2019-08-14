import React from "react";

const Select = ({ value, label, options, onChange, name, error }) => {
  return (
    <div className="form-group">
      <label htmlFor={name}>{label}</label>
      <select
        name={name}
        className="form-control"
        id={name}
        placeholder={`Enter ${label}`}
        value={value}
        onChange={onChange}
      >
        {options.map(option => (
          <option key={option.id} value={option.id}>
            {option.name}
          </option>
        ))}
      </select>
      {error && <div className="alert alert-danger mt-1">{error}</div>}
    </div>
  );
};

export default Select;
