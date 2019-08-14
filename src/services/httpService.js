import axios from "axios";
import { toast } from "react-toastify";

// Putting null as first parameter means we don’t want to intercept success;
// Returning a rejected promise takes us back to the catch block.
// If the promise is rejected we go to the catch block and deal with a specific error.

axios.interceptors.response.use(null, error => {
  const expectedError =
    error.response &&
    error.response.status >= 400 &&
    error.response.status < 500;

  if (!expectedError) {
    toast.error("An unexpected error occurred.");
  }

  return Promise.reject(error);
});

/*function setJwt(jwt) {
    axios.defaults.headers.common["x-auth-token"] = jwt;
}*/

export default {
  get: axios.get,
  post: axios.post,
  put: axios.put,
  delete: axios.delete
  // setJwt
};
