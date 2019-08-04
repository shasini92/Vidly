import React from "react";

const Input = ({ value, onChange, name, label, type, error }) => {
  return (
    <div className="form-group">
      <label htmlFor={name}>{label}</label>
      <input
        name={name}
        type={type}
        className="form-control"
        id={name}
        placeholder={`Enter ${label}`}
        value={value}
        onChange={onChange}
      />
      {error && <div className="alert alert-danger mt-1">{error}</div>}
    </div>
  );
};

export default Input;
