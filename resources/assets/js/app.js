import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Router, Route, hashHistory, IndexRoute } from 'react-router';

import MenuBar from './components/layout/MenuBar';
import Links from './components/Links';
import Tags from './components/Tags';

import './bootstrap';

class App extends Component {
	render() {
		return (
			<div>
				<MenuBar />
				<div className="container">
					{ this.props.children }
				</div>
			</div>
		);
	}
}

ReactDOM.render(
	<Router history={hashHistory}>
    <Route component={App} path="/">
      <IndexRoute component={Links} />
      <Route path="/" component={Links}/>
      <Route path="/tags" component={Tags}/>
    </Route>
	</Router>,
	document.getElementById('root')
);