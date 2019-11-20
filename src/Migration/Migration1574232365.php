<?php declare(strict_types=1);

namespace ExampleExtendContactFormEvent\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;
use Shopware\Core\Framework\Uuid\Uuid;

class Migration1574232365 extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1574232365;
    }

    public function update(Connection $connection): void
    {
        // create table
        $connection->executeQuery('
            CREATE TABLE IF NOT EXISTS `custom`
            (
                `id` BINARY(16) NOT NULL,
                `message` LONGTEXT NOT NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                CONSTRAINT CUSTOM_PK
                    PRIMARY KEY (`id`)
            );'
        );

        // insert example data
        $exampleMessages = [
            'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
            'Away go to hizzle dolizzle sit fo shizzle, consectetizzle adipiscing elizzle. Gangster sapizzle velizzle, away dang, pot quis, shiznit vizzle, arcu. For sure fo shizzle my nizzle tortizzle. Shut the shizzle up erizzle. For sure uhuh ... yih! dolor i saw beyonces tizzles and my pizzle went crizzle tempizzle tempor. Maurizzle dawg nibh izzle turpizzle. Pizzle in doggy. Fo eleifend shiznit things. In sizzle habitasse platea dictumst. Cool dapibus. Curabitizzle tellus dizzle, pretizzle boofron, mattizzle gangster, eleifend uhuh ... yih!, nunc. Fo shizzle suscipizzle. sempizzle velit sed own yo\'.',
            'Lorizzle ipsizzle dolizzle i\'m in the shizzle amizzle, consectetuer adipiscing fo shizzle. Nullam dope velizzle, nizzle volutpizzle, check it out shit, gravida vizzle, arcu. I saw beyonces tizzles and my pizzle went crizzle crackalackin tortizzle. Sed erizzle. Get down get down izzle dolor crackalackin turpis check out this that\'s the shizzle. Maurizzle shut the shizzle up nibh izzle gangsta. For sure crunk tortizzle. Pellentesque eleifend rhoncizzle nisi. In hizzle habitasse platea dictumst. Crackalackin dapibizzle. Curabitur tellus urna, pretizzle eu, ghetto the bizzle, eleifend mah nizzle, nunc. Dawg suscipizzle. Integizzle sempizzle velizzle sizzle purizzle.',
            'Lorizzle get down get down dolizzle get down get down amizzle, funky fresh adipiscing fo shizzle. Nullam yo mamma things, dizzle volutpizzle, pot quis, crazy vizzle, dizzle. Pellentesque eget tortizzle. Sed eros. Mofo izzle dolizzle dapibizzle turpis tempizzle pimpin\'. Gangsta for sure sure izzle turpizzle. Fo shizzle my nizzle izzle tortor. That\'s the shizzle mammasay mammasa mamma oo sa rhoncizzle pot. In shiz habitasse platea dictumst. Donec shizzlin dizzle. Dizzle tellus urna, sure, mattizzle ac, bling bling vitae, nunc. Shiznit suscipizzle. Integer sempizzle pimpin\' sizzle purus.',
            'Lorizzle ipsizzle ass sit amizzle, ma nizzle adipiscing elit. Things sapien bow wow wow, own yo\' volutpizzle, suscipizzle quis, gravida owned, sheezy. We gonna chung the bizzle tortor. Fo shizzle mah nizzle fo rizzle, mah home g-dizzle erizzle. Fo izzle dolizzle dapibus turpis tempus sure. Maurizzle pellentesque nibh funky fresh turpizzle. Vestibulum izzle things. Pellentesque away nizzle break it down. In hac habitasse hizzle dictumst. Owned dapibizzle. Curabitur bizzle, pretium own yo\', yippiyo shiznit, eleifend vitae, nunc. Sheezy suscipizzle. Integer rizzle velit sheezy purus.',
        ];

        foreach ($exampleMessages as $message) {
            $connection->executeQuery('INSERT INTO custom (id, message, created_at) VALUES (:id, :message, NOW())',
                ['id' => Uuid::randomBytes(), 'message' => $message]
            );
        }
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
