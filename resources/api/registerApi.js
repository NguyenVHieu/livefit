import axios from 'axios'
import { REGISTER } from './configApi'

const registerApi = async payload => {
  let data
  try {
    await axios.post(REGISTER, payload)
      .then(res => {
        data = res
      })
    return data
  } catch (error) {
    console.log(error)
  }
}

export default registerApi
