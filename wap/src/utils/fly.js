import fly from 'flyio'
fly.config.headers.Accept = 'application/json, text/plain, */*'
fly.config.timeout = 50000
fly.config.baseURL = import.meta.env.VITE_BASE_API

fly.interceptors.request.use(request => {
  // request.headers.token
  return request
})

fly.interceptors.response.use(
  res => {
    return res.data
  },
  err => {
    console.log(err)
  },
)

export default fly
