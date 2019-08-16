import http from "./httpService";
import { userApiLogin } from "../config/API";
import jwtDecode from "jwt-decode";

async function login(user) {
  const {
    data: { jwt },
    data: { message }
  } = await http.post(userApiLogin, user);
  // Set JWT to Local Storage
  localStorage.setItem("token", jwt);
  return message;
}

function loginWithJwt(jwt) {
  localStorage.setItem("token", jwt);
}

function logout() {
  localStorage.removeItem("token");
}

function getCurrentUser() {
  try {
    const jwt = localStorage.getItem("token");
    const { data: user } = jwtDecode(jwt);
    return user;
  } catch (ex) {
    // This scenario is when we don't have a JWT in the LS
    return null;
  }
}

export default {
  login,
  logout,
  getCurrentUser,
  loginWithJwt
};
