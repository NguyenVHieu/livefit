import axios from 'axios'
import { GET_USER } from './configApi'

const getUser = async () => {
  const token = localStorage.getItem('userToken')
  let data
  try {
    await axios.get(GET_USER, {
      headers: {
        Authorization: "Bearer " + token
    },
    })
    .then(res => {
        data = res
      })
    return data
  } catch (error) {
    console.log(error)
  }
}
export default getUser
