import React, { Component } from 'react';
import { Link } from 'react-router';
import Select from 'react-select';

import 'react-select/dist/react-select.css';
import TagService from '../../services/TagService';

class LinksForm extends Component {
  constructor(props) {
    super(props);

    this.state = {
      tags: [],
      tagsValue: null
    };

    this.handleInputChangeTags = this.handleInputChangeTags.bind(this);
    this.getTags = this.getTags.bind(this);
  }

  getTags() {
    TagService.all((data) => {
      this.setState({
        tags: data
      });
    }, (data) => {
      alert('Ocorreu um erro ao buscar as tags: ' + data.message);
    });
  }

  handleInputChangeTags(event) {
    this.setState({
      tagsValue: event
    });

    this.props.handleInputChange(event);
  }

  componentWillMount() {
    this.getTags();
  }

  render() {
    const { callbackSave, handleInputChange, title, url, tags } = this.props;

    return (
      <div>
        <form onSubmit={callbackSave}>

          <div className="form-group">
            <label htmlFor="title">Título</label>
            <input type="text" className="form-control" name="title" value={title} placeholder="Título" onChange={handleInputChange}/>
          </div>

          <div className="form-group">
            <label htmlFor="url">URL</label>
            <input type="text" className="form-control" name="url" value={url} placeholder="URL" onChange={handleInputChange}/>
          </div>

          <div className="form-group">
            <label htmlFor="tags">Tags</label>
            <Select.Creatable
              multi
              value={this.state.tagsValue || tags}
              name="selectTag"
              valueKey="id"
              labelKey="title"
              options={this.state.tags}
              onChange={this.handleInputChangeTags}
            />
          </div>

          <button type="submit" className="btn btn-default">Salvar</button>

          <Link to="/" className="btn btn-default" style={{marginLeft: '5px'}}>
            Voltar
          </Link>

        </form>
      </div>
    );
  }
}

LinksForm.propTypes = {
  callbackSave: React.PropTypes.func.isRequired,
  handleInputChange: React.PropTypes.func.isRequired
};

export default LinksForm;
