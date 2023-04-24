#!/bin/sh

for f in `find .`; do
	sudo chown www:other "$f"
	sudo chmod g+w "$f"
	echo "$f"
done
