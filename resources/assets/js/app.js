import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import MenuBar from './components/layout/MenuBar';

import './bootstrap';

class App extends Component {
	render() {
		return (
			<div>
				<MenuBar />
				<div className="container">
					... conteudo ...
				</div>
			</div>
		);
	}
}

ReactDOM.render(
	<App />,
	document.getElementById('root')
);