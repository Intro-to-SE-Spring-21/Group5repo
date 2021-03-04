const express = require('express');
const bodyParser = require('body-parser');
const app = express();

app.use(bodyParser.urlencoded({ extended: true })); 

app.post('/', (req, res) => {
  res.send(`Full name is:${req.body.fname} ${req.body.lname}.`);
});

const port = 8080;

app.listen(port, () => {
  console.log(`Server running on port${port}`);
});