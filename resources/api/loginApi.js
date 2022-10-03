import axios from 'axios'
import { LOGIN } from './configApi'

const loginApi = async payload => {
  let data
  try {
    await axios.post(LOGIN,  payload )
      .then(res => {
        data = res
      })
    return data
  } catch (error) {
    console.log(error)
  }
}

export default loginApi
