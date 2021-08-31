# BlockStub Needs a Cool Name

## ℹ️ What's this for?

> What if building custom blocks for the Block Editor was as easy as supplying attributes and a block of HTML? What if this produced React editing code and PHP rendering code without a build step?

Here's the premise: many metaboxes and custom blocks being built for clients represent a particular front-end component for a site where the content management needs are more tightly curated than something like a [pattern](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-patterns/). The React-based WordPress block editor (sometimes referred to as Gutenberg) is a powerful tool for WYSIWYG editing that continues to prove to be somewhere between a speed bump and a roadblock for long-time WordPress developers who historically have been more PHP-centric.

The developer workflow being targeted by this work is one where front-end outcomes are prioritized, beginning with the "slice and dice", if you will. By leveraging the familiar parts of PHP-based templating and creating a bridge that demonstrates the power of React when combined with the markup and styling already being done for the front-end, we can de-duplicate code, help demystify the critical role of JavaScript in modernizing WordPress, and serve as an on-ramp for PHP-centric developers to create compelling and delightful 1:1 live preview editing experiences.

## Why is a 1:1 live preview the ideal?

In a metabox context, you're probably used to creating a form-centric experience where users need to save to preview their changes, and have probably also struggled at some point with the fact that out of the box WordPress does not have a concept of draft post meta. This is what we call "save and surprise", and 

This goes beyond the 1:1 visual representation and live-updating preview, though. After all, you could still end up with a form-based experience that is updating a separate preview area. The full ideal is what some might call front-end editing: manipulating content in place, being able to get a sense of your content in context as you work, whether text or image or something more. Computers should be a tool for humans to get things done effectively, not an entity for us to accommodate.

## How do React and the block editor make 1:1 WYSIWYG easier to achieve?

tl;dr: JSX is cool and the block editor ships with lots of React components that handle many common editing needs out of the box.

### The long of it, which is basically a blog post from here to the end:

Take this overly simplified example of a text-based front-end component, ignoring editable data for the moment:

```html
<div class="info">
	<h2>Here is my headline</h2>
	<p>And here is some more information you need to know</p>
</div>
```

Blocks have two places where they output: on the front-end, and in the editor. So on the front-end, this would be the block's output. In the editor, the output can be written using what's known as JSX, where the X stands for XML and provides a clean and familiar syntax. If we take that front-end component and turn it into JSX, here's what it looks like:

```js
<div className="info">
	<h2>Here is my headline</h2>
	<p>And here is some more information you need to know</p>
</div>
```

There is only one difference: `class` becomes `className`. That's it.

So if we include the front-end CSS into our editor stylesheet, scoped with at least the `.editor-styles-wrapper` class, this will now be styled just like the front-end of the site. (Well, mostly, there are some nuances around defaults such as block width, but we can add details after we get the basics down. Also yes so far you need a build step.)

Now let's add some data in. We're going to use block attributes and make this a dynamically rendered block - that is, rather than storing fully formed HTML into the database, the output relies on block attributes, a bit more like post meta minus the issues with drafts and revisions. Again ignoring the details around how attributes are defined and populated, we get something like this:

```html
<div class="info">
	<h2><?php echo $attributes['headline']; ?>></h2>
	<p><?php echo $attributes['info']; ?>></p>
</div>
```

The content within the `h2` and `p` tags has been replaced with outputting variables from PHP. These variables represent user-editable content, so those are the "fields" we need to surface in the block editor.

The block editor ships with many React components that can essentially be plugged into place within the markup. You know, like a fields API! Once again, we're going to skip over the details about things like `import` you would need in a full file, but your markup output will look something like this:

```js
<div className="info">
	<RichText
		tagName="h2"
		placeholder={__('Enter headline', 'my-namespace')}
		value={headline}
		onChange={(headline) => {
			setAttributes({ headline });
		}}
		allowedFormats={[]}
	/>
	<RichText
		tagName="p"
		placeholder={__('Enter info text', 'my-namespace')}
		value={info}
		onChange={(info) => {
			setAttributes({ info });
		}}
		allowedFormats={['core/bold', 'core/italic']}
	/>
</div>
```

These things like `tagName="h2"` are called `props` and we've broken them into separate lines for readability and maintenance, but you can see that much like the initial move into JSX maintained that HTML/XML style, these are not entirely dissimilar from HTML attributes. That change from `class` to `className`? It's because `class` is a JavaScript keyword already, so the `prop` is named `className`.

If we were to delete all those `props`, you'd end up with a neatly self-closing `<RichText />` "element", which is what's known as a React component. This is an example of a component that the block editor provides out of the box, allowing you to type directly into place within the block itself, instead of relegating the editing experience to a contextless form input.

At this point, you might have noticed something: the basic markup is duplicated between the PHP and the JS(X) sides of the block output. Even if you are familiar with the rest of the things you need to do to make a block work, this is a not-insignificant hurdle, but it's the magic that makes the editor a true 1:1 experience that _reacts_ to the data as you input it.

When we have duplicated markup, we turn to templates. If you've ever used a templating system like Mustache, this version of the markup might look familiar to you:

```html
<div class="info">
	<h2>{{headline}}</h2>
	<p>{{info}}</p>
</div>
```

So what if harnessed something like a templating system where we could just write our markup once and turn that into the PHP version and the React/JSX version? That's what this project is exploring and hoping to solve. It's unlikely we'll be able to solve for every complex experience a block might need, but at the very least it can serve as a place to start transitioning developer thinking from PHP-centric static experiences to ones that **also** embrace JavaScript to bring that dynamic and, yes, delightful experience to WordPress users.
