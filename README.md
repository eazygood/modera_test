# Modera test tasks
## Task 1

Sort items and represent it as tree with paddings.
(node_id|parent_id|name|)

Input data:
````
12|11|20D
11|9|Canon
9|8|DSLR
1|0|Electronics
6|4|iPod
4|1|MP3 player
10|9|Nikon
3|0|Photo
7|6|Shuffle
8|3|SLR
5|1|TV
2|0|Video
````
Output data:
````
Electronics
- MP3 Player
-- iPod
--- Shuffle
- Tv
Video
Photo
- SLR
-- DSLR
--- Nikon
--- Canon
---- 20D
````
## Task 2
Build REST API

* Fetching category by id

* Searching categories by category name

* Fetching all subcategories (1 level) of category (search by parent category id)

* Creating new category

* Updating category info (name and also category position in structure)

* Removing category


## Task 3
_Not Done Yet_

Create page for categories structure rendering.

You can use Bootstrap or other framework for theming.

