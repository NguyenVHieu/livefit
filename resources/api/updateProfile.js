import axios from "axios";
import {UPDATE_PROFILE} from "./configApi"

const updateProfile = async(dataUser) => {
    let data;
    const token = localStorage.getItem('userToken')
    // let date = `${birthDay.year}-${birthDay.month}-${birthDay.date}`
    // dataUser.birthday = date
    try {
        await axios.post(UPDATE_PROFILE, dataUser, {
            headers: {
              Authorization: "Bearer " + token
          },
          })
        .then(res => {
            data = res
        })
        return data;
    } catch (error) {
        console.log(error);
    }
}
export default updateProfile