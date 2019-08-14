import http from "./httpService";
import {
  movieApiCreate,
  movieApiDelete,
  movieApiRead,
  movieApiReadSingle,
  movieApiUpdate
} from "../config/API";

export function getMovies() {
  return http.get(movieApiRead);
}

export function getMovie(id) {
  return http.get(movieApiReadSingle + id);
}

export function saveMovie(movie) {
  // If it is an existing movie update it, else create a new movie
  if (movie.id) {
    return http.put(movieApiUpdate + movie.id, movie);
  }

  return http.post(movieApiCreate, movie);
}

export function deleteMovie(id) {
  return http.delete(movieApiDelete + id);
}
