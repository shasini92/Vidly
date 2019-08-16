import React from "react";
import { Redirect, Route } from "react-router-dom";
import auth from "../../services/authService";

// using "...rest" we pick any other properties passed to this Component
const ProtectedRoute = ({ path, component: Component, render, ...rest }) => {
  return (
    <Route
      // path={path}
      {...rest}
      render={props => {
        if (!auth.getCurrentUser())
          return (
            <Redirect
              to={{ pathname: "/login", state: { from: props.location } }}
            />
          );
        // If the component is null use the render method
        return Component ? <Component {...props} /> : render(props);
      }}
    />
  );
};

export default ProtectedRoute;
