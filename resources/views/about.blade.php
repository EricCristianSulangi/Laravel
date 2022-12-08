@extends('layout')

<!DOCTYPE html>
<html>
			<head>
				<title>Register</title>
				<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
			<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
			</head>
			<body>
				<form method="POST" action="/about" class= "card ">
					@csrf
				<div class="main">  	
					<input type="checkbox" id="chk" aria-hidden="true">
			
						<div class="signup">
							<form>
							<div class="register">
								<label for="chk" aria-hidden="true">Register</label>
							</div>
								<input type="string" name="name" placeholder="User name" required="">
								<input type="email" name="email" placeholder="Email" required="">
								<input type="password" name="password" placeholder="Password" required="">
								<button>Register</button>
							</form>
						</div>
