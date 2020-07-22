
package com.cristian.dayclass;
import java.io.Serializable;
import java.util.Date;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.persistence.Temporal; 

@Entity
@Table(name="ContraseniaRestablecida", schema="dayclass")
public class ContraseniaRestablecida implements Serializable {
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    private int id;
    private String contraseniaProvisoria;
     @Temporal(javax.persistence.TemporalType.DATE)
    private Date vigenciaContraDesde;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date vigenciaContraHasta;

    public ContraseniaRestablecida() {
    }

    public static long getSerialVersionUID() {
        return serialVersionUID;
    }

    public int getId() {
        return id;
    }

    public String getContraseniaProvisoria() {
        return contraseniaProvisoria;
    }

    public Date getVigenciaContraDesde() {
        return vigenciaContraDesde;
    }

    public Date getVigenciaContraHasta() {
        return vigenciaContraHasta;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setContraseniaProvisoria(String contraseniaProvisoria) {
        this.contraseniaProvisoria = contraseniaProvisoria;
    }

    public void setVigenciaContraDesde(Date vigenciaContraDesde) {
        this.vigenciaContraDesde = vigenciaContraDesde;
    }

    public void setVigenciaContraHasta(Date vigenciaContraHasta) {
        this.vigenciaContraHasta = vigenciaContraHasta;
    }
    
    
    
    
    
}
