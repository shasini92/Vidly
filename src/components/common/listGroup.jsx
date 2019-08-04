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
    <div>
      <Link to="/movies/new" className="btn btn-primary btn-block mt-2 mb-3">
        New Movie
      </Link>
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
    </div>
  );
};

ListGroup.defaultProps = {
  textProperty: "name",
  valueProperty: "_id"
};

export default ListGroup;
