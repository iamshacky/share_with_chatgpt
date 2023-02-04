

const markdownPreTags = document.querySelectorAll("pre");


markdownPreTags.forEach(preTag => {
  let markdown = preTag.innerHTML;
  let html = "";

  
  // Parsing Headings
  html = markdown.replace(/(\n#{1,6})\s(.*)/g, (match, heading, text) => {
    return `<h${heading.length - 1}>${text}</h${heading.length - 1}>`;
  });

  // Parsing Bold
  html = html.replace(/\*\*(.*?)\*\*/g, "<strong>$1</strong>");

  // Parsing Emphasis
  html = html.replace(/\*(.*?)\*/g, "<em>$1</em>");

  // Parsing Lists
  html = html.replace(/^\s*(\d+\.)\s(.*)/gm, "<ol><li>$2</li></ol>");
  html = html.replace(/^\s*(\-)\s(.*)/gm, "<ul><li>$2</li></ul>");

  // Parsing Color
  html = html.replace(/\[color=(.*?)\](.*?)\[\/color\]/g, (match, color, text) => {
    return `<span style="color:${color}">${text}</span>`;
  });

  preTag.innerHTML = html;
});
