<html>
<head>
	<title> <?php echo $page_title; ?> </title>
	<style> @import url('./styles/main.css'); </style>
	<style>
	.test-class {
		color: blue;
	}

	input.user-email {
		display: block;
		font-size: 0.8rem;
		overflow: visible;
		border: medium none;
		text-align: center;
		border-radius: 0px;
		cursor: pointer;
		font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
		font-weight: normal;
		text-decoration: none;
		background-color: #008CBA;
		color: #fff;
		width: 500px;
		margin-left: 10px;
		border-bottom: 5px solid gray;
		padding: 5px;
	}

	.friend-email {
		display: inline-block;
		font-size: 0.8rem;
		height: 2rem;
		line-height: 2rem;

		border: medium none;
		padding: 0px;
		text-align: center;
		border-radius: 0px;
		cursor: pointer;
		font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
		font-weight: bold;
		text-decoration: none;
		background-color: #23BA42;
		color: #fff;
		width: 500px;
		border-bottom: 5px solid black;
	}

	.inbox-msg-input {
		display: block;
		font-size: 0.8rem;
		height: 2rem;
		line-height: 2rem;
		overflow: visible;
		border: medium none;
		text-align: center;
		border-radius: 0px;
		cursor: pointer;
		font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
		font-weight: bold;
		text-decoration: none;
		background-color: #008CBA;
		color: #fff;
		width: inherit;
	}

	#msg-details {
		border: 2px solid black;
		padding: 10px;
	}

	.inbox-msg-input-not-new {
		display: block;
		font-size: 0.8rem;
		height: 2rem;
		line-height: 2rem;
		overflow: visible;
		border: medium none;
		text-align: center;
		border-radius: 0px;
		cursor: pointer;
		font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
		font-weight: normal;
		text-decoration: none;
		background-color: gray;
		color: #fff;
		width: inherit;
	}

	.user-search {
		margin-bottom: 5px;
		width: 500px;
		background: gray;
	}

	.friend-search {
		margin-left: 10px;
		margin-bottom: 5px;
		width: 500px;
		background: gray;
	}

	#users-info {
		width: 500px;
		background: #008CBF;
		color: white;
		font-weight: bold;
		padding-left: 10px;
	}

	input.send-msg {
		float:left;
		display: inline-block;
		border: medium none;
		background-color: #008CBA;
		color: #fff;
		cursor: pointer;
		padding: 5px;
		width:150px;
	}

	input.add-friend {
		display: inline-block;
		border: medium none;
		background-color: #23BA42;
		color: #fff;
		cursor: pointer;
		padding: 5px;
		width:150px;
	}

	input.remove-friend {
		display: inline-block;
		border: medium none;
		background-color: #ED4107;
		color: #fff;
		cursor: pointer;
		padding: 5px;
		width:150px;
	}

	div.inbox {
		float: left;
		width: 200px;
		border: 1px solid blue;
		height: 200px;
	}

	.inbox-msg {
		border-bottom: 5px black solid;
		display: inline-block;
		width: inherit;
		margin: 0px;
	}

	.inbox-input {
		width:100px;
		float:left;
		display: inline-block;
		font-size: 1rem;
		font-style: italic;
		font-weight: normal;
		margin-top: -1px;
		margin-bottom: 1px;
		padding: 0.33333rem 0.5rem 0.5rem;
		background: #F04124;
		color: #FFF;
	}

	.sent-input {
		width:100px;
		float: right;
		display: inline-block;
		font-size: 1rem;
		font-style: italic;
		font-weight: normal;
		margin-top: -1px;
		padding: 0.33333rem 0.5rem 0.5rem;
		background: orange;
		color: #FFF;
	}

</style>
</head>