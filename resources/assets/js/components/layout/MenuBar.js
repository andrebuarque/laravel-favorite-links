import React, { Component } from 'react';
import { Link } from 'react-router';

import UserService from '../../services/UserService';

class MenuBar extends Component {
  constructor(props) {
    super(props);
  
    this.state = {
      username: ''
    };
  }

  componentDidMount() {
    UserService.getUserName((user) => {
      this.setState({ username: user.name });
    });
  }

	render() {
		return (
			<nav className="navbar navbar-default navbar-static-top">
				<div className="container">
					<div className="navbar-header">
            <button type="button" className="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
              <span className="sr-only">Toggle Navigation</span>
              <span className="icon-bar"></span>
              <span className="icon-bar"></span>
              <span className="icon-bar"></span>
            </button>
			      <a className="navbar-brand" href="/home">
			          Links Favoritos
			      </a>
					</div>
					<div className="collapse navbar-collapse" id="app-navbar-collapse">
						<ul className="nav navbar-nav">
              &nbsp;
            </ul>
            <ul className="nav navbar-nav navbar-right">
            	<li><Link to="/">Links</Link></li>
							<li><Link to="/tags">Tags</Link></li>
							<li className="dropdown">
            		<a href="#" className="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            			{ this.state.username } <span className="caret"></span>
            		</a>
            		<ul className="dropdown-menu" role="menu">
            			<li>
            				<Link to="#"
                        onClick={(event) => { event.preventDefault();document.getElementById('logout-form').submit(); }}>
                        Logout
                    </Link>
                    <form id="logout-form" action="/logout" method="POST" style={{display: 'none'}}>
                      <input type="hidden" name="_token" value={ window.Laravel.csrfToken } />
                    </form>
            			</li>
            		</ul>
            	</li>
            </ul>
					</div>
				</div>
			</nav>
		);
	}
}

export default MenuBar;