const sendRequest = (query) => {
  return axios.get(`/api/get?${query}`);
}

export default sendRequest;