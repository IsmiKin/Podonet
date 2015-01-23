<?php
/**
 * Created by PhpStorm.
 * User: ismikin
 * Date: 17/01/15
 * Time: 11:46
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="FotoPerfil")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\FotoPerfilRepository")
 */
class FotoPerfil extends Document{


    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="Usuario_idUsuario", referencedColumnName="id",nullable=false)
     **/
    private $usuario;

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }



    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents/usuarios/fotoperfil/'.$this->usuario->getUsername();
    }

    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // aquí usa el nombre de archivo original pero lo debes
        // sanear al menos para evitar cualquier problema de seguridad

        // move takes the target directory and then the
        // target filename to move to

        // ISKN MOD-
        // ponemos al campo name el username del usuario .. si sube una foto se machacara (para la subida del archivo)
        // OJO!!
        // lo hacemos asi para tener un nombre fijo que buscar dentro del twig.. no sirve para otros casos
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->usuario->getUsername().".jpg"
        );

        // ponemos al campo name el username del usuario .. si sube una foto se machacara (para la BD)
        // OJO!!
        // lo hacemos asi para tener un nombre fijo que buscar dentro del twig.. no sirve para otros casos
        $this->setName($this->usuario->getUsername());
        // set the path property to the filename where you've saved the file
        $this->setPath($this->usuario->getUsername());

        // limpia la propiedad «file» ya que no la necesitas más
        $this->setFile(null);
    }


}
