console.log("Block Editor");

wp.blocks.registerBlockStyle("core/quote", {
  name: "fancy-quote",
  label: "Fancy Quote",
});

wp.blocks.registerBlockStyle("core/paragraph", {
  name: "pko-paragraph",
  label: "Pko Paragraph",
});

wp.domReady(function () {
  wp.blocks.unregisterBlockStyle("core/quote", "large");
  wp.blocks.unregisterBlockStyle("core/quote", "plain");
});
