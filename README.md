# Connect for Craft

This plugin is for developers with smaller sites that don't need the entire
kitchen sink. This plugin simply makes it easy to grab posts from a Facebook
Page and make them available in your templates.

## Basic Usage

    {% for post in craft.connect.posts() %}
        {{ post.message|raw }}
        {{ post.created_time|date('F j, Y g:i A')}}
    {% endfor %}

## Limiting Posts

If you want a certain number of posts, you can tell Connect to limit it by
passing an integer. If you don't specify, Connect defaults to 5.

It looks like this:

    {% for post in craft.connect.posts(3) %}
    	{{ post.message|raw }}
    	{{ post.created_time }}
    {% endfor %}

## Current Issues

#### Message Escaping
Right now you have to specify that the `post.message` is a raw value in order
for Craft not to escape the HTML links you might have. This will be done
automatically in a future update.