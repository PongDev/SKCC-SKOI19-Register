#!/usr/bin/env node
const express=require('express');
const bodyParser=require('body-parser');
const app=express();
const createRegisterForm=require('./registerForm');

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended:true}));

app.post('/', (req,res)=>{
  console.log('Receive Connection');
  res.setHeader('Content-Type','application/pdf');
  res.setHeader('Content-Disposition','inline; filename=SKOI2018.pdf');
  console.log('Creating PDF');
  createRegisterForm(JSON.parse(req.body.data),res);
});

app.listen(1030,()=>console.log('Listening on port 1030'));
