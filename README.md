# Connect for Craft
A simple plugin that retrieves Facebook Page information from the GRAPH API.

## Usage

    {% for item in craft.connect.getPosts() %}
	    {{ item.message }}<br>
	    {{ item.created_time|date('F j, Y g:i A') }}
    {% endfor %}