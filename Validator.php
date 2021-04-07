<?php
class Validator extends DataManager
{
    public function check($r, $c, $current, $c_diff)
    {
        $count = 0;
        for ($i = 1; $i <= 3; $i++) {
            $c = $c + $c_diff;
            if ($current === $this->get($r, $c)) {
                $count++;
            } else {
                break;
            }
        }

        if ($count >= 3) {
            echo "Spēlē ir uzvarēta!";
        }
    }
}
