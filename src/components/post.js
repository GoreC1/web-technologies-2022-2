export class Post {
  #el = null;
  #renderPost = null;
  #postEl = null;
  #commentsEl = null;
  #getPost = null;
  #postId = null;
  #getComments = null;
  #renderComment = null;

  constructor(el, options) {
    const { renderPost, getPost, getComments, renderComment } = options;
    this.#el = el;
    this.#postEl = el.querySelector('[data-post]');
    this.#commentsEl = el.querySelector('[data-comments]');
    this.#renderPost = renderPost;
    this.#getPost = getPost;
    this.#getComments = getComments;
    this.#renderComment = renderComment;

    window.onpopstate = () => {
      this.init();
    };
  }

  init() {
    const url = new URL(window.location.href);
    const postId = +url.searchParams.get('id');

    this.#postId = postId;

    this.loadPost();
  }

  async loadPost() {
    const post = await this.#getPost({ id: this.#postId });
    if (post.error) {
      alert(post.error);
      return;
    }
    const comments = await this.#getComments({ id: this.#postId });
    console.log(post);
    if (comments.error) {
      alert(comments.error);
      return;
    }
    this.renderPost(post);
    this.renderComments(comments);
  }

  renderPost({ data: { title, body } }) {
    const element = document.createElement('div');
    element.innerHTML = `
        <b>${title}</b>
        <div>
            ${body}
        </div>
    `;
    this.#postEl.appendChild(element);
  }

  renderComments({ items }) {
    this.#commentsEl.innerHTML = items
      .map(
        ({ name, body }) => `
            <b>${name}</b>
            <div>${body}</div>
        `
      )
      .join('');
  }
}
