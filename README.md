# TagWrapper Plugin for October CMS

Manipulates the DOM and wraps selected HTML-Elements into a defined wrapper.

## How it works

This plugin can be used to define various selectors and wrappers. It provides a middleware that searches for the selected elements and wrap them into a defined parent HTML-Tag.

As an example it turns this

```
<table class="myTable">
...
</table>
```

into this

```
<div class="table-wrapper">
  <table class="myTable">
  ...
  </table>
</div>
```
 
## Configuration

You can define the selectors and wrappers by recording these in the backend.

| Field                          | Description                                                                                                                          | Example                           |
|--------------------------------|--------------------------------------------------------------------------------------------------------------------------------------|-----------------------------------|
| Tag that should be wrapped     | Defines the selector as a XPath expression. All applicable elements are selected by the plugin and wrapped with the defined wrapper. | //table[contains(@class,"table")] |
| Type of wrapper-tag            | Defines the HTML-tag-type for the wrapper.                                                                                           | div                               |
| Optional class for wrapper-tag | If defined, this value is set as a class-attribute to the wrapper.                                                                   | table-wrapper-class               |
| Optional id for wrapper-tag.   | If defined, this value is set as a id-attribute to the wrapper.                                                                      | table-wrapper-id                  |

## Bug reports

It is very likely that there will be bugs with some specific html markup. If you encounter such a bug, please report it.

## Future plans

* Add multiple classes and ids to the wrapper.