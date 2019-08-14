import http from "./httpService";
import { userApiCreate, userApiDelete, userApiReadSingle } from "../config/API";

export function register(user) {
  return http.post(userApiCreate, user);
}

export function deleteUser(id) {
  return http.delete(userApiDelete + id);
}

export function getUser(id) {
  return http.get(userApiReadSingle + id);
}
