const sendRequest = (query) => {
  return axios.get(`http://localhost:8000/api/get?${query}`);
}

export default sendRequest;