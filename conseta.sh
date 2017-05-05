#!/bin/bash
if test -z "${MONGO_1_PORT_27017_TCP_ADDR}" -o -z "${MONGO_1_PORT_27017_TCP_PORT}"; then
    echo "You must link this container with mongo first"
    exit 1
fi

if test -z "${REDIS_1_PORT_6379_TCP_ADDR}" -o -z "${REDIS_1_PORT_6379_TCP_PORT}"; then
    echo "You must link this container with redis first"
    exit 1
fi

export TESTING_MONGO_URL="mongodb://${MONGO_1_PORT_27017_TCP_ADDR}:${MONGO_1_PORT_27017_TCP_PORT}"
export TESTING_REDIS_URL="tcp://${REDIS_1_PORT_6379_TCP_ADDR}:${REDIS_1_PORT_6379_TCP_PORT}"

# See http://tldp.org/LDP/abs/html/devref1.html for description of this syntax.
while ! exec 6<>/dev/tcp/${MONGO_1_PORT_27017_TCP_ADDR}/${MONGO_1_PORT_27017_TCP_PORT}; do
    echo "$(date) - still trying to connect to mongo at ${TESTING_MONGO_URL}"
    sleep 1
done

exec 6>&-
exec 6<&-

while ! exec 6<>/dev/tcp/${REDIS_1_PORT_6379_TCP_ADDR}/${REDIS_1_PORT_6379_TCP_PORT}; do
    echo "$(date) - still trying to connect to redis at ${TESTING_REDIS_URL}"
    sleep 1
done

exec 6>&-
exec 6<&-

$@
