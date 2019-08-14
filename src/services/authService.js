import http from "./httpService";
import { userApiLogin } from "../config/API";

export function login(user) {
  return http.post(userApiLogin, user);
}
