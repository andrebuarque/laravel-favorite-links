import React, {Component} from 'react';
import {Link} from 'react-router';
import Select from 'react-select';

import 'react-select/dist/react-select.css';

class LinksForm extends Component {
  constructor(props) {
    super(props);

    this.state = {
      tags: [{
        id: 1, title: 'tag1'
      }, {
        id: 2, title: 'tag2'
      }],
      tagsValue: []
    };

    this.handleInputChangeTags = this.handleInputChangeTags.bind(this);
  }

  handleInputChangeTags(event) {
    this.setState({
      tagsValue: event
    });

    this.props.handleInputChange(event);
  }

  componentDidMount() {

  }

  render() {
    const {callbackSave, handleInputChange} = this.props;
    const {tags, tagsValue} = this.state;

    return (
      <div>
        <form onSubmit={callbackSave}>

          <div className="form-group">
            <label htmlFor="title">Título</label>
            <input type="text" className="form-control" name="title" placeholder="Título" onChange={handleInputChange}/>
          </div>

          <div className="form-group">
            <label htmlFor="url">URL</label>
            <input type="text" className="form-control" name="url" placeholder="URL" onChange={handleInputChange}/>
          </div>

          <div className="form-group">
            <label htmlFor="tags">Tags</label>
            <Select.Creatable
              multi
              value={tagsValue}
              name="selectTag"
              valueKey="id"
              labelKey="title"
              options={tags}
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