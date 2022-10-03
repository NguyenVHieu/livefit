import axios from "axios";
import {FORGOT_PASSWORD} from "./configApi"


const forgotPassword = async(payload) => {
    let data;
    try {
        await axios.post(FORGOT_PASSWORD, payload)
        .then(res => {
            data = res
        })
        return data
    } catch (error) {
        console.log(error);
    }
    
}
export default forgotPassword