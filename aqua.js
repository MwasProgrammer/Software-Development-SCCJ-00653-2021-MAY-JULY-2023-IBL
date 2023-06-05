const [waterIntake, setWaterIntake] = useState(0);
const interval = 3600000; // Remind every 1 hour (you can change this value)

useEffect(() => {
  const reminder = setInterval(() => {
    // Show a notification reminding to drink water
    notification.open({
      message: 'Water Reminder',
      description: 'Remember to drink water!',
      duration: 10,
    });
  }, interval);

  // Clean up the interval when the component unmounts
  return () => {
    clearInterval(reminder);
  };
}, []);

const drinkWater = () => {
  setWaterIntake(waterIntake + 1);
};