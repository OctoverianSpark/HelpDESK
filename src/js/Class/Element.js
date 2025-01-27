export class Element {
  constructor(objectName, attributes = {}, methods = {}, childs = []) {
    this._objectName = objectName;
    this._attributes = attributes;
    this._methods = methods;
    this._childs = childs;
  }

  render() {
    const element = document.createElement(this._objectName);

    Object.entries(this._attributes).forEach(([key,value]) => {

      element.setAttribute(key, value);
    });

    Object.entries(this._methods).forEach(([key,value]) => {

      element[key] = value;
    });

    this._childs.forEach((child) => {
      element.appendChild(
        child instanceof Element
          ? child.render()
          : document.createTextNode(child)
      );
    });

    return element;
  }
}
