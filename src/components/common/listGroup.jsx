import React from "react";
import { Link } from "react-router-dom";

const ListGroup = ({
  items,
  textProperty,
  valueProperty,
  onItemSelect,
  selectedGenre
}) => {
  return (
    <ul className="list-group">
      {items.map(item => (
        <li
          key={item[valueProperty]}
          className={
            item === selectedGenre
              ? "list-group-item active"
              : "list-group-item"
          }
          onClick={() => onItemSelect(item)}
        >
          {item[textProperty]}
        </li>
      ))}
    </ul>
  );
};

ListGroup.defaultProps = {
  textProperty: "name",
  valueProperty: "id"
};

export default ListGroup;
