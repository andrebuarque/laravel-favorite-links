import React, { Component } from 'react';
import { Link } from 'react-router';

import PageHeader from '../layout/PageHeader';
import Form from './TagsForm';

class TagsCreate extends Component {
  constructor(props) {
    super(props);
  
    this.state = {
      title: ''
    };

    this.handleInputChange = this.handleInputChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  handleInputChange(event) {
    const target = event.target;

    this.setState({
      [target.name]: target.value
    });
  }

  handleSubmit(event) {
    event.preventDefault();

    alert(`save the tag with name: ${this.state.title}`);
  }

	render() {
		return (
			<div>
        <PageHeader title="Nova tag" />

        <div style={{ marginTop: '15px' }}>
          <Form handleInputChange={this.handleInputChange} callbackSave={this.handleSubmit} />
        </div>
      </div>
		);
	}
}

export default TagsCreate;