// import { $themeConfig } from '@themeConfig'

export default {
  namespaced: true,
  state: {
    listPlans: {
      plansFemales: [
        {
          id: 1101,
          describe: 'Pull-ups',
          type: 'female',
          image: 'https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Pullups_F_WorkoutLabs.svg',
          time: {
            sets: 3,
            sec: 60,
          },

        },
        {
          id: 1102,
          describe: 'Barbell Deadlifts',
          type: 'female',
          image: 'https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Barbell_Deadlift_F_WorkoutLabs.svg',
          time: {
            sets: 4,
            sec: 90,
            reps: 10,
          },
        },
        {
          id: 1103,
          describe: 'Bent Over Barbell Rows',
          type: 'female',

          image: 'https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Bent_Over_Barbell_Row_F_WorkoutLabs.svg',
          time: {
            sets: 4,
            reps: 10,
            sec: 90,
          },
        },
        {
          id: 1104,
          describe: 'Rear Delt Pull',
          type: 'female',

          image: 'https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Face_pull_F_WorkoutLabs.svg',
          time: {
            sets: 3,
            reps: 12,
            sec: 60,
          },
        },
        {
          id: 1105,
          describe: 'Barbell Curls',
          type: 'female',

          image: 'https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Barbell_Curl_F_WorkoutLabs.svg',
          time: {
            sets: 3,
            reps: 10,
            sec: 60,
          },
        },
      ],
      planMale: [
        {
          id: 1106,
          describe: 'Pull-ups',
          type: 'male',
          image: 'https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Pullup_M_WorkoutLabs.svg',
          time: {
            sets: 3,
            sec: 60,
          },
          processing: null

        },
        {
          id: 1107,
          describe: 'Barbell Deadlifts',
          type: 'male',

          image: 'https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Barbell_Deadlift_M_WorkoutLabs.svg',
          time: {
            sets: 4,
            sec: 90,
            reps: 10,
          },
          processing: null

        },
        {
          id: 1108,
          describe: 'Bent Over Barbell Rows',
          type: 'male',

          image: 'https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Bent_Over_Barbell_Row_M_WorkoutLabs.svg',
          time: {
            sets: 4,
            reps: 10,
            sec: 90,
          },
          processing: null

        },
        {
          id: 1109,
          describe: 'Rear Delt Pull',
          type: 'male',

          image: 'https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Face_pull_M_WorkoutLabs.svg',
          time: {
            sets: 3,
            reps: 12,
            sec: 60,
          },
          processing: null

        },
        {
          id: 11010,
          describe: 'Barbell Curls',
          type: 'male',

          image: 'https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Barbell_Curle_M_WorkoutLabs.svg',
          time: {
            sets: 3,
            reps: 10,
            sec: 60,
          },
          processing: null

        },
      ],
    },
    listPlanSearch: [
      {
        id: 1,
        like: false,
        type: 'male',
        image: "https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Assisted_Tricep_Dips.svg",
        title: "180 / Twisting Jump Squats ",
        time: {
          sets: null,
          sec: null,
          reps: null,
        },
        
      },
      {
        id: 2,
        like: false,
        type: 'male',
        image: "https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Ab_Crunch_Machine_M_WorkoutLabs.svg",
        title: 'Ab Crunch Machine ',
        time: {
          sets: null,
          sec: null,
          reps: null,
        },
      },
      {
        id: 3,
        like: false,
        type: 'male',
        image: "https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Ab_Roller_Wheel_Rollout_M_WorkoutLabs.svg",
        title: "Ab Roller",
        time: {
          sets: null,
          sec: null,
          reps: null,
        },
      },
      {
        id: 4,
        like: false,
        type: 'male',
        image: "https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Thigh_Adductor_Inner_Thigh_Machine_M_WorkoutLabs.svg",
        title: "Adduction",
        time: {
          sets: null,
          sec: null,
          reps: null,
        },
      },
      {
        id: 5,
        like: false,
        type: 'male',
        image: "https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2017/10/Agility_Ladder_Drills.svg",
        title: "Agility Ladder Drills ",
        time: {
          sets: null,
          sec: null,
          reps: null,
        },
      },
      {
        id: 6,
        like: false,
        type: 'male',
        image: "https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Air_Squats.svg",
        title: "Air Squats",
        time: {
          sets: null,
          sec: null,
          reps: null,
        },
      },
      {
        id: 7,
        like: false,
        type: 'male',
        image: "https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Alternate_Heel_Touchers_M_WorkoutLabs.svg",
        title: "Alternate Heel Touches",
        time: {
          sets: null,
          sec: null,
          reps: null,
        },
      },
      {
        id: 8,
        like: false,
        type: "female",
        image: "https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/180_Jump_Squats-1.svg",
        title: '180 / Twisting Jump Squats ',
        time: {
          sets: null,
          sec: null,
          reps: null,
        },
      },
      {
        id: 9,
        like: false,
        type: "female",
        image: "https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Ab_Crunch_Machine_F_WorkoutLabs-2.svg",
        title: "Ab Crunch Machine",
        time: {
          sets: null,
          sec: null,
          reps: null,
        },
      },
      {
        id: 10,
        like: false,
        type: "female",
        image: "https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Ab_Roller_Wheel_Rollout_F_WorkoutLabs.svg",
        title: "Ab Roller",
        time: {
          sets: null,
          sec: null,
          reps: null,
        },
      },
      {
        id: 11,
        like: false,
        type: "female",
        image: "https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Thigh_Adductor_Inner_Thigh_Machine_F_WorkoutLabs.svg",
        title: 'Adduction',
        time: {
          sets: null,
          sec: null,
          reps: null,
        },
      },
      {
        id: 12,
        like: false, 
        type: "female",
        image: "https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2017/10/Agility_Ladder_Drills-1.svg",
        title: "Agility Ladder Drills ",
        time: {
          sets: null,
          sec: null,
          reps: null,
        },
      },
      {
        id: 13,
        like: false,
        type: "female",
        image: "https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Air_Squats-1.svg",
        title: "Air Squats "
      },
      {
        id: 14,
        like: false,
        type: "female",
        image: "https://cdn-xi3mbccdkztvoept8hl.netdna-ssl.com/train/wp-content/uploads/2019/02/Alternate_Heel_Touchers_F_WorkoutLabs.svg",
        title: "Alternate Heel Touches",
        time: {
          sets: null,
          sec: null,
          reps: null,
        },
      }
    ]

  },
  mutations: {
    ADD_NEW_PLAN(state, payload){
      if(payload.type == 'male'){
        state.listPlans.planMale.push(payload)
      }else {
        state.listPlans.plansFemales.push(payload)
      }
    },
    SET_TIME(state, payload){
      if(payload.type == 'male'){

        for (const item of state.listPlans.planMale) {
          if(item.id == payload.id){
            item.time = {
              sets: payload.sets,
              sec: payload.second,
              reps: payload.reps
            }
            break;
          }
        }
      } else {
        for (const item of state.listPlans.plansFemales) {
          if(item.id == payload.id){
            item.time = {
              sets: payload.sets,
              sec: payload.second,
              reps: payload.reps
            }
            break;
          }
        }
      }
    }
  },
  actions: {
    addNewPlan({commit}, {payload}){
      commit("ADD_NEW_PLAN", payload)
    },
    addTime({commit}, {payload}){
      commit("SET_TIME", payload)
    }
  },
}
