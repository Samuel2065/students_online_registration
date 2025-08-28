const express = require('express');
const cors = require('cors');

const app = express();
const PORT = 3000;

// Middleware
app.use(cors());
app.use(express.json());

console.log('🚀 Démarrage du serveur...');

// Données en mémoire (pour tester)
let students = [
  {
    id: 1,
    name: 'John Doe',
    email: 'john@example.com',
    field: 'Informatique'
  },
  {
    id: 2,
    name: 'Jane Smith',
    email: 'jane@example.com',
    field: 'Médecine'
  }
];

let nextId = 3;

// ============= ROUTES =============

// Route de santé
app.get('/api/health', (req, res) => {
  res.json({
    message: 'API fonctionne correctement !',
    timestamp: new Date().toISOString()
  });
});

// Obtenir tous les étudiants
app.get('/api/students', (req, res) => {
  res.json({
    message: 'Liste des étudiants',
    students: students,
    total: students.length
  });
});

// Obtenir un étudiant par ID
app.get('/api/students/:id', (req, res) => {
  const id = parseInt(req.params.id);
  const student = students.find(s => s.id === id);
  
  if (!student) {
    return res.status(404).json({ message: 'Étudiant non trouvé' });
  }
  
  res.json({
    message: 'Étudiant trouvé',
    student: student
  });
});

// Créer un nouvel étudiant
app.post('/api/students', (req, res) => {
  const { name, email, field } = req.body;
  
  if (!name || !email) {
    return res.status(400).json({ message: 'Nom et email requis' });
  }
  
  // Vérifier si l'email existe déjà
  const existingStudent = students.find(s => s.email === email);
  if (existingStudent) {
    return res.status(400).json({ message: 'Cet email existe déjà' });
  }
  
  const newStudent = {
    id: nextId++,
    name,
    email,
    field: field || 'Non spécifié'
  };
  
  students.push(newStudent);
  
  res.status(201).json({
    message: 'Étudiant créé avec succès',
    student: newStudent
  });
});

// Mettre à jour un étudiant
app.put('/api/students/:id', (req, res) => {
  const id = parseInt(req.params.id);
  const studentIndex = students.findIndex(s => s.id === id);
  
  if (studentIndex === -1) {
    return res.status(404).json({ message: 'Étudiant non trouvé' });
  }
  
  const { name, email, field } = req.body;
  
  if (name) students[studentIndex].name = name;
  if (email) students[studentIndex].email = email;
  if (field) students[studentIndex].field = field;
  
  res.json({
    message: 'Étudiant mis à jour avec succès',
    student: students[studentIndex]
  });
});

// Supprimer un étudiant
app.delete('/api/students/:id', (req, res) => {
  const id = parseInt(req.params.id);
  const studentIndex = students.findIndex(s => s.id === id);
  
  if (studentIndex === -1) {
    return res.status(404).json({ message: 'Étudiant non trouvé' });
  }
  
  const deletedStudent = students.splice(studentIndex, 1)[0];
  
  res.json({
    message: 'Étudiant supprimé avec succès',
    student: deletedStudent
  });
});

// Rechercher des étudiants
app.post('/api/students/search', (req, res) => {
  const { term } = req.body;
  
  if (!term) {
    return res.status(400).json({ message: 'Terme de recherche requis' });
  }
  
  const results = students.filter(student => 
    student.name.toLowerCase().includes(term.toLowerCase()) ||
    student.email.toLowerCase().includes(term.toLowerCase()) ||
    student.field.toLowerCase().includes(term.toLowerCase())
  );
  
  res.json({
    message: `Résultats de recherche pour "${term}"`,
    students: results,
    count: results.length
  });
});

// Statistiques
app.get('/api/stats', (req, res) => {
  const fieldCounts = students.reduce((acc, student) => {
    acc[student.field] = (acc[student.field] || 0) + 1;
    return acc;
  }, {});
  
  res.json({
    message: 'Statistiques des étudiants',
    total: students.length,
    by_field: fieldCounts
  });
});

// Route 404
app.use('*', (req, res) => {
  res.status(404).json({
    message: 'Route non trouvée',
    path: req.originalUrl
  });
});

// Démarrer le serveur
app.listen(PORT, () => {
  // console.log(✅ Serveur démarré sur http://localhost:${PORT});
  // console.log(🔍 Test: http://localhost:${PORT}/api/health);
  // console.log(📚 Routes disponibles:);
  console.log(`   GET    /api/health`);
  console.log(`   GET    /api/students`);
  console.log(`   POST   /api/students`);
  console.log(`   GET    /api/students/:id`);
  console.log(`   PUT    /api/students/:id`);
  console.log(`   DELETE /api/students/:id`);
  console.log(`   POST   /api/students/search`);
  console.log(`   GET    /api/stats`);
});