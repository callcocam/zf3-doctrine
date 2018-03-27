bin/doctrine-module orm:convert-mapping --filter="User" --from-database annotation --namespace="Admin\\Entity\\" module/Admin/src/
 bin/doctrine-module orm:generate-entities --filter="User" --generate-annotations="true" --generate-methods="true" -- module/Admin/src/Entity
 bin/doctrine-module orm:generate-repositories module/Admin/src/
