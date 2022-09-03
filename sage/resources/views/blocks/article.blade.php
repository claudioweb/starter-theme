{{--
  Title: Artigo
  Description: Bloco para inserir card de artigo ao conteúdo
  Category: formatting
  Icon: admin-comments
  Keywords: article
  Mode: preview
  PostTypes: page post
--}}

@if(is_admin() && empty($block['data']['article']))
  Card de artigo: selecione um artigo para ser exibido
@endif

@empty(!$block['data']['article'])
  @php
    $post = get_post($block['data']['article']);
    // $category = \App\get_first_term($post);
  @endphp

  @empty(!$block['data']['article'])
    {{-- @include('partials.card-article', [
      'post' => [
        'ID' => $post->ID,
        'url' => get_permalink($post),
        'title' => $post->post_title,
        'image_id' => get_post_thumbnail_id($post),
        'category' => $category->name,
        'category_url' => get_category_link($category),
        'format' => get_post_format($post),
        'excerpt' => get_the_excerpt($post),
      ],
    ]) --}}
    <div style="background: #f00; color: #fff; width: 100%; height: 100%;">
      {{$post->post_title}}
      {{$post->post_content}}
    </div>
  @endempty
@endempty
