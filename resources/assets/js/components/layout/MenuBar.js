import React, { Component } from 'react';

class MenuBar extends Component {
	render() {
		return (
			<div className="container">
				<div className="header clearfix">
	        <nav>
	          <ul className="nav nav-pills pull-right">
	          	<li role="presentation">
	          		<a href="#">Links</a>
	          	</li>
	          	<li role="presentation">
	          		<a href="#">Tags</a>
	          	</li>
	          	<li role="presentation">
	          		<a href="#">Categorias</a>
	          	</li>
	            <li role="presentation" className="active">
		            <a href="#" onClick={() => { document.getElementById('form').submit(); }}>
			          	<i className="glyphicon glyphicon-off"></i>
			        </a>
			        <form action='/logout' method='POST' id='form'>
			        	<input type="hidden" name="_token" value={window.Laravel.csrfToken} />
			        </form>
	            </li>
	          </ul>
	        </nav>
	        <h3 className="text-muted">Links úteis</h3>
	      </div>
      </div>
		);
	}
}

export default MenuBar;