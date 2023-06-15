import { Post } from './src/components/post.js';

const getPost = async ({ id }) => {
  const res = await fetch(`https://jsonplaceholder.typicode.com/posts/${id}`);

  if (!res.ok) {
    return { error: res.statusText };
  }
  const data = await res.json();

  return { data };
};

const getComments = async ({ id }) => {
  const res = await fetch(
    `https://jsonplaceholder.typicode.com/posts/${id}/comments`
  );

  if (!res.ok) {
    return { error: res.statusText };
  }
  const data = await res.json();

  return { items: data };
};

const init = () => {
  const post = document.getElementById('post');
  new Post(post, {
    getPost,
    getComments,
  }).init();
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', init);
} else {
  init();
}
