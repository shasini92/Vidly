import React from "react";
import Joi from "joi-browser";
import Form from "./common/form";
import auth from "../services/authService";
import { Redirect } from "react-router-dom";

class LoginForm extends Form {
  state = {
    data: {
      username: "",
      password: ""
    },
    errors: {}
  };

  schema = {
    username: Joi.string()
      .required()
      .label("Username"),
    password: Joi.string()
      .required()
      .label("Password")
  };

  doSubmit = async () => {
    //Call the server
    const message = await auth.login(this.state.data);

    if (message === "User doesn't exist.") {
      const errors = [...this.state.errors];
      errors.username = message;
      this.setState({ errors });
    } else if (message === "Invalid password.") {
      const errors = [...this.state.errors];
      errors.password = message;
      this.setState({ errors });
    } else if (message === "Successful login.") {
      // Send user to home page or the last page user was on and fully reload the application
      const { state } = this.props.location;
      window.location = state ? state.from.pathname : "/";
    }
  };

  render() {
    if (auth.getCurrentUser()) return <Redirect to="/" />;
    return (
      <div>
        <h1>Login</h1>
        <form onSubmit={this.handleSubmit}>
          {this.renderInput("username", "Username")}
          {this.renderInput("password", "Password", "password")}
          {this.renderButton("Login")}
        </form>
      </div>
    );
  }
}

export default LoginForm;
