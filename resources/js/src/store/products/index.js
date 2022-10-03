// import { $themeConfig } from '@themeConfig'

export default {
  namespaced: true,
  state: {
    productDetail: null,
    listProduct: [
      {
        id: "san-pham-01",
        mini: false,
        category: '11',
        category2: 'fullgym',
        time: 8,
        image:
            'https://workoutlabs.com/fit/wp-content/uploads/2022/02/limit-fat-burn-training-plan-workoutlabs.jpg',
        title: 'HIIT the Limit: Gym Fat-Burn Plan',
        title2: 'Advanced',
        color: 'red',
        members: 50,
        sub_title:
            "Ready to challenge yourself in ways you've never experienced before? Take on HIIT the Limit – a new kind of fat-burning gym plan!",
      },
      {
        id: "san-pham-02",
        mini: false,
        category: '12',
        category2: "full gym",
        time: 8,
        image:
            'https://workoutlabs.com/fit/wp-content/uploads/2017/03/total-body-toning-gym-workout-plan.jpg',
        title: 'Total Body Tone: Gym Workout Plan',
        title2: 'Intermediate',
        color: 'blue',
        members: 98,
        popular: true,
        sub_title:
            'The title doesn’t leave much mystery but the plan itself does. The Total Body Toning plan’s magic will reveal your fantastic body hiding beneath that soft layer covering it – in only 8 weeks.',
      },
      {
        id: "san-pham-03",
        mini: false,
        category: '3',
        category2: 'full gym',
        time: 6,
        image:
            'https://workoutlabs.com/fit/wp-content/uploads/2017/02/beginner-full-body-transformation-gym-training-plan.jpg',
        title: 'Beginner Full Body Transformation',
        title2: 'Beginner',
        color: 'green',
        members: 25,
        popular: true,
        sub_title:
            'Great for starting your fitness journey, this beginner training plan will leave pounds of body fat crying in a pool on the ground. It will be emotional.',
      },
      {
        id: "san-pham-04",
        mini: false,
        category: '11',
        category2: "no equipmrnt",
        time: 6,
        image:
            'https://workoutlabs.com/fit/wp-content/uploads/2017/11/home-power-intermediate-weight-loss-toning-plan.jpg',
        title: 'Home Power: No-Equipment Fat Loss & Toning Plan',
        title2: 'Intermediate',
        color: 'blue',
        members: 68,
        popular: true,
        sub_title:
            'Ready to advance things a little more in the casa? All you need is some space and a tough mindset. This plan will help you do the rest.',
      },
      {
        id: "san-pham-05",
        mini: false,
        category: '12',
        category2: 'full gym',
        time: 4,
        image:
            'https://workoutlabs.com/fit/wp-content/uploads/2017/02/four-week-intensive-slim-down-gym-training-plan.jpg',
        title: 'Four Week Intensive Slim Down',
        title2: 'Intermediate',
        color: 'blue',
        members: 30,
        sub_title:
            'This 5-workouts-per-week gym training plan for women and men will get you in tip-top shape pronto. Ready to sweat? Let’s go!',
      },
      {
        id: "san-pham-06",
        mini: false,
        category: '11',
        category2: 'no equipmrnt',
        time: 8,
        image:
            'https://workoutlabs.com/fit/wp-content/uploads/2017/03/habitat-at-home-no-equipment-plan21.jpg',
        title: 'Home Advantage: Ultimate No-Equipment Plan',
        title2: 'Beginner',
        color: 'green',
        members: 79,
        sub_title:
            "Who needs a gym when you’re perfectly able to whip that body into shape in the comfort of your own home? You can even complete the workouts in your undies. Let's go!",
      },
      {
        id: "san-pham-07",
        mini: false,
        category: '12',
        category2: 'Resistance bands',
        time: 8,
        image:
            'https://workoutlabs.com/fit/wp-content/uploads/2020/10/bands-bottles-full-body-crafting-plan.jpg',
        title: 'Bands & Bottles: Full Body Crafting Plan',
        title2: 'Beginner',
        color: 'green',
        members: 38,
        sub_title:
            'It’s time to dust off those resistance bands and grab a couple of water bottles (or dumbbells if you’ve got them). Your muscles are ready to arrive and your body fat is ready to vacate.',
      },
      {
        id: "san-pham-08",
        mini: false,
        category: '1',
        category2: "full gym",
        time: 6,
        image:
            'https://workoutlabs.com/fit/wp-content/uploads/2017/05/engage-intermediate-full-body-crafting-plan.jpg',
        title: 'Engage: Intermediate Full Body Crafting Plan',
        title2: 'Intermediate',
        color: 'blue',
        members: 97,
        popular: true,
        sub_title:
            'If you’ve completed the Beginner Transformation Plan or if you’re ready for something a little more challenging, this plan is for you.',
      },
      {
        id: "san-pham-09",
        mini: false,
        category: '1',
        category2: 'full gym',
        time: 6,
        image:
            'https://workoutlabs.com/fit/wp-content/uploads/2017/04/intro-to-weightlifting-6-week-beginner-plan1.jpg',
        title: 'Intro to Weightlifting: Gym Novice Plan',
        title2: 'Beginner',
        color: 'green',
        members: 212,
        sub_title:
            'Just joined the gym and want a proper and safe introduction to weightlifting? This 6-week plan is designed for you.',
      },
      {
        id: "san-pham-10",
        mini: false,
        category: '11',
        category2: 'full gym',
        time: 8,
        image:
            'https://workoutlabs.com/fit/wp-content/uploads/2019/08/total-body-toning-2-gym-workout-plan.jpg',
        title: 'Total Body Tone 2: Advanced Gym Plan',
        title2: 'Advanced',
        color: 'red',
        members: 36,
        sub_title:
            'Are you ready to continue carving away at that Greek God-like statue of a physique? This advanced plan will give you all the tools you need. Get sculpting!',
      },
      {
        id: "san-pham-11",
        mini: false,
        category: '2',
        category2: 'full gym',
        time: 8,
        image:
            'https://workoutlabs.com/fit/wp-content/uploads/2017/03/incredible-bulk-muscle-gainer-workout-plan1.jpg',
        title: 'The Incredible Bulk: Muscle Gainer',
        title2: 'Intermediate',
        color: 'blue',
        members: 59,
        sub_title:
            '8 weeks to have you looking like a gladiator’s statue carved out of marble by the Greek God Zeus himself! Challenge accepted!',
      },
      {
        id: "san-pham-12",
        mini: false,
        category: '2',
        category2: "full gym",
        time: 6,
        image:
            'https://workoutlabs.com/fit/wp-content/uploads/2017/07/pure-power-advanced-strength-training-plan.jpg',
        title: 'Pure Power: Strength and Toning Training Plan',
        title2: 'Intermediate',
        color: 'blue',
        members: 80,
        sub_title:
            'When intermediate plans begin to feel too easy, you’re ready for something new. Something that will make you sweat the way you should and ache the way you secretly want to.',
      },



      {
        id: "san-pham-13",
        mini: true,
        popular: true,
        category: '1',
        category2: 'full gym',
        time: '33-50',
        image: "https://workoutlabs.com/fit/wp-content/uploads/2017/06/baby-got-back-back-butt-resistance-band-workout-pack3.jpg",
        title: "Baby Got Back: Back & Butt 3-Day Workout Pack",
        title2: "Intermediate",
        color: 'blue',
        members: 89,
        sub_title: "When people hate to see you go, but love to watch you leave – give them something to look at."
      },
      {
        id: "san-pham-14",
        mini: true,
        category: '11',
        category2: "no equipment",
        time: '31-42',
        image: "https://workoutlabs.com/fit/wp-content/uploads/2019/08/no-equipment-workout-variety-pack.jpg",
        title: "No-Equipment Workout Variety Pack",
        title2: "Beginner",
        color: "green",
        members: 12,
        sub_title: "Not quite ready to commit to a full workout plan? No worries, we’ve got you more than covered!"
      },
      {
        id: "san-pham-15",
        mini: true,
        category: "11",
        category2: "no equipment",
        time: "24-39",
        image: "https://workoutlabs.com/fit/wp-content/uploads/2020/03/quarantine-workout-pack.jpg",
        title: "On Lockdown: Five At-Home Workouts",
        title2: "Beginner",
        color: "green",
        members: 55,
        sub_title: "When life gives you a contagious virus, work on improving your health and fitness!"
      },
      {
        id: "san-pham-16",
        popular: true,
        mini: true,
        category: "12",
        category2: "full gym",
        time: 60,
        image: "https://workoutlabs.com/fit/wp-content/uploads/2017/03/pure-abs-attack-and-booty-blast-gym-workout.jpg",
        title: "Pure Abs Attack & Booty Blast Gym Workout",
        title2: "Intermediate",
        color: "blue",
        members: 321,
        sub_title: "Im not a fan of firm abs and a squat booty - Said no one, ever. Which is why we’re going to focus on those two wonderful features of the human form."
      },
      {
        id: "san-pham-17",
        mini: true,
        category: "12",
        category2: "full gym",
        time: 30,
        image: "https://workoutlabs.com/fit/wp-content/uploads/2017/03/beer-belly-abolisher-core-toning-workout.jpg",
        title: "Beer Belly Abolisher: Core Toning Workout",
        title2: "Intermediate",
        color: "blue",
        members: 47,
        sub_title: "There are many ways to hide a beer belly, but frankly why not just do away with it once and for all? This targeted ab workout will help you do just that."
      },
      {
        id: "san-pham-18",
        popular: true,
        mini: true,
        category: "1",
        category2: "no equipment",
        time: 9,
        image: "https://workoutlabs.com/fit/wp-content/uploads/2017/03/energize-awaken-beginner-yoga-sequence.jpg",
        title: "Energize & Awaken Yoga Sequence",
        title2: "Beginner",
        members: 60,
        color: "green",
        sub_title: "Perfect for sluggish mornings or anytime you need an energy boost, this sequence invigorates both mind and body."
      }
    ],
  },
  mutations: {
    
  },
  actions: {
    
  },
}
