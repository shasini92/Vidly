import http from "./httpService";
import { genreApiEndPoint } from "../config/API";

export function getGenres() {
  return http.get(genreApiEndPoint);
}
