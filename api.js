import express from "express";
const app = express();
const port = 3000;

app.use(express.json());

// Exemple de données
let students = [
  { id: 1, name: 'Alice' },
  { id: 2, name: 'Bob' }
];

// GET all students
app.get('/api/students', (req, res) => {
  res.json(students);
});

// GET student by id
app.get('/api/students/:id', (req, res) => {
  const student = students.find(s => s.id === parseInt(req.params.id));
  if (!student) return res.status(404).send('Student not found');
  res.json(student);
});

// POST create new student
app.post('/api/students', (req, res) => {
  const { name } = req.body;
  const newStudent = { id: students.length + 1, name };
  students.push(newStudent);
  res.status(201).json(newStudent);
});

// PUT update student
app.put('/api/students/:id', (req, res) => {
  const student = students.find(s => s.id === parseInt(req.params.id));
  if (!student) return res.status(404).send('Student not found');
  student.name = req.body.name;
  res.json(student);
});

// DELETE student
app.delete('/api/students/:id', (req, res) => {
  students = students.filter(s => s.id !== parseInt(req.params.id));
  res.status(204).send();
});

app.listen(port, () => {
  console.log(`API listening at http://localhost:${port}`);
});